<script setup>
import { reactive, computed, ref } from 'vue';
import { addEmployee } from '@/api/employee.service.js';
import moment from 'moment'

const props = defineProps(['modelValue'])
const emits = defineEmits(["update:modelValue", "successC"]);

const newSkills = reactive([{
	name: null,
	expertice: 0
}])

const addNewSkill = () => {
	newSkills.push({
		name: null,
		expertice: 0
	})
}

const fields=ref({
	name:"",
	email:"",
	birthday:moment().format("d/m/Y"),
	position:"",
	skills:[],
	address:"",
	latitude:"",
	longitude:""
})
const rules=ref({
	name:[
		v => !!v || 'Nombre es requerido',
		v => (v && v.length <= 20) || 'Nombre debe ser menor o igual a 20 letras',
	],
	email:[
		v => !!v || 'Email es requerido',
		v => (v && /^[a-z.-]+@[a-z.-]+\.[a-z]+$/i.test(v)) || 'Debe ser un email valido',
	],
	birthday:[
		v => !!v || 'Cumpleaños es requerido'
	],
	position:[
		v => !!v || 'Nombre es requerido',
		v => (v && v.length <= 20) || 'Nombre debe ser menor o igual a 20 letras',
	]
})

const canSaveSkills = computed(() => {
	if (!newSkills.length) return false
	return newSkills.every(skill => {
		const experticeIsValid = skill.expertice && skill.expertice > 0 && skill.expertice < 6
		return skill.name && experticeIsValid
	});
})

const deletThisRow = (key) => {
	newSkills.splice(key, 1)
}

const addEmployeeF = async () => {
	fields.value.birthday=moment(fields.value.birthday).format('DD/MM/YYYY')
	fields.value.skills=newSkills
	const response = await addEmployee(fields.value)
	console.log(response)
	if(response.status===1){
		emits("update:modelValue",false);
		emits("successC")
	}
}

</script>
<template>
	<v-dialog :model-value="props.modelValue" @input="emits('update:modelValue', $event)" width="80vw">
		<v-card>
			<v-card-title>
					Nuevo empleado
			</v-card-title>
			<v-card-text ref="form">
				<v-text-field
					v-model="fields.name"
					:counter="20"
					:rules="rules.name"
					label="Name"
					required
				></v-text-field>
				<v-text-field
					v-model="fields.email"
					:rules="rules.email"
					label="E-mail"
					required
				></v-text-field>
				<v-text-field
					v-model="fields.birthday"
					:rules="rules.birthday"
					label="Cumpleaños"
					required
					type="date"
				></v-text-field>
				<v-text-field
					v-model="fields.position"
					label="Puesto"
					required
				></v-text-field>
				<v-text-field
					v-model="fields.address"
					label="Direccion"
				></v-text-field>
				<v-text-field
					v-model="fields.longitude"
					label="Latitud"
				></v-text-field>
				<v-text-field
					v-model="fields.latitude"
					label="Longitud"
				></v-text-field>
			</v-card-text>
			<v-card-text>
				<v-row no-gutters v-for="(newSkill, skillIdx) in newSkills" :key="skillIdx">
					<v-col cols="8">
						<v-text-field label="Nombre de skill" v-model="newSkill.name" />
					</v-col>
					<v-col cols="3">
						<v-text-field label="Expertice" v-model="newSkill.expertice" type="number" />
					</v-col>
					<v-col cols="1">
						<!-- metodo para borrar -->
						<v-icon v-if="skillIdx > 0" @click="deletThisRow(skillIdx)">mdi-trash-can</v-icon>
					</v-col>
				</v-row>
				<v-row no-gutters>
					<v-btn color="info" variant="outlined" class="mr-2" @click="addNewSkill()"
						:disabled="!canSaveSkills">Agregar otra skill</v-btn>
					<v-btn color="success" @click="addEmployeeF()" :disabled="!canSaveSkills">Crear Empleado</v-btn>
				</v-row>
			</v-card-text>
		</v-card>
	</v-dialog>
</template>