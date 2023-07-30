<script setup>
import { reactive, computed } from 'vue';
import { addSkillToEmployee } from '@/api/employee.service.js';

const props = defineProps(['user_id','modelValue'])
const emits = defineEmits(["update:modelValue","success"]);

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

const canSaveSkills = computed(() => {
	if (!newSkills.length) return false
	return newSkills.every(skill => {
		const experticeIsValid = skill.expertice && skill.expertice > 0 && skill.expertice < 6
		return skill.name && experticeIsValid
	})
})

const deletThisRow = (key) => {
	newSkills.splice(key, 1)
}

const addNewSkills = async () => {
	const response = await addSkillToEmployee({id:props.user_id,skills:newSkills})
	console.log(response)
	if(response.status===1){
		newSkills.splice(0,newSkills.length)
		newSkills.push({
			name: null,
			expertice: 0
		})
		emits("update:modelValue",false);
		emits("success")
	}
}

</script>
<template>
	<v-dialog :model-value="props.modelValue" @input="emits('update:modelValue',$event)" width="80vw">
		<v-card>
			<v-card-text>
				<v-row no-gutters v-for="(newSkill, skillIdx) in newSkills" :key="skillIdx">
					<v-col cols="8">
						<v-text-field label="Nombre de skill" v-model="newSkill.name" />
					</v-col>
					<v-col cols="3">
						<v-text-field label="Expertice" v-model="newSkill.expertice" type="number" />
					</v-col>
					<v-col cols="1">
						<v-icon v-if="skillIdx > 0" @click="deletThisRow(skillIdx)" >mdi-trash-can</v-icon>
					</v-col>
				</v-row>
				<v-row no-gutters>
					<v-btn color="info" variant="outlined" class="mr-2" @click="addNewSkill()" :disabled="!canSaveSkills">Agregar otra skill</v-btn>
					<v-btn color="success" @click="addNewSkills()" :disabled="!canSaveSkills">Guardar Skills</v-btn>
				</v-row>
			</v-card-text>
		</v-card>
	</v-dialog>
</template>