<script setup>
import { onMounted, ref } from 'vue';
import { VDataTable } from 'vuetify/labs/VDataTable'

import { getEmpoyeeList } from '@/api/employee.service.js';
import { getEmpoyeeDetail } from '@/api/employee.service.js';

import EmployeeAddSkillDialog from '@/components/employees/EmployeeAddSkillDialog.vue'
import EmployeeAdd from '@/components/employees/EmployeeAdd.vue'

const headers = ref([
	{ title: 'Nombre', key: 'name' },
	{ title: 'Correo', key: 'email' },
	{ title: 'Puesto', key: 'position' },
	{ title: 'Fecha de nacimiento', key: 'birthday' },
	{ title: '', key: 'actions' },
])
const items = ref([]);
const dialogDetail = ref(false);
const employeeDetail = ref(null);
const dialogCreateEmployee = ref(null);
const addSkills = ref(false);

const verDetallesEmpleado = async ({ id }) => {
	const response = await getEmpoyeeDetail(id)
	if (response.status === 1) {
		employeeDetail.value = response.data;
		dialogDetail.value = true;
	}
}
const getList = async () => {
	const response = await getEmpoyeeList()
	if (response.status === 1) {
		items.value = response.data
	}
}

onMounted(()=>{
	getList()
}
)
</script>

<template>
	<v-row no-gutters>
		<v-data-table :items="items" :headers="headers">
			<template #top>
				<v-row class="justify-end" no-gutters>
					<v-btn class="text-none bg-blue ml-auto" @click="dialogCreateEmployee=true">
						Agregar empleado
					</v-btn>
					<EmployeeAdd v-model="dialogCreateEmployee" @successC="getList( )" />
				</v-row>
			</template>
			<template #[`item.actions`]="{ item }">
				<v-btn color="success" size="small" @click="verDetallesEmpleado(item.raw)">
					Ver detalles
					<v-icon class="ml-2">mdi-eye</v-icon>
				</v-btn>
			</template>
		</v-data-table>
		<v-dialog v-if="employeeDetail" v-model="dialogDetail">
			<v-card>
				<v-card-title>
					Empleado {{ employeeDetail.employee.name }}
				</v-card-title>
				
				<v-card-text>
					
					<v-container >
						<v-row no-gutters>
							<v-col>
								<v-sheet class="pa-2 ma-2">
								Nombre: {{ employeeDetail.employee.name }}
								</v-sheet>
							</v-col>
							<v-col>
								<v-sheet class="pa-2 ma-2">
								email: {{ employeeDetail.employee.email }}
								</v-sheet>
							</v-col>
							<v-col>
								<v-sheet class="pa-2 ma-2">
								Puesto: {{ employeeDetail.employee.position }}
								</v-sheet>
							</v-col>
							<v-col>
								<v-sheet class="pa-2 ma-2">
								Cumpleaños {{ employeeDetail.employee.birthday }}
								</v-sheet>
							</v-col>
						</v-row>
						<v-row no-gutters>
							<v-col>
								<v-sheet class="pa-2 ma-2">
								Direccion: {{ employeeDetail.employee.address }}
								</v-sheet>
							</v-col>
							<v-col>
								<v-sheet class="pa-2 ma-2">
								Latitud: {{ employeeDetail.employee.latitude }}
								</v-sheet>
							</v-col>
							<v-col>
								<v-sheet class="pa-2 ma-2">
								Longitud: {{ employeeDetail.employee.longitude }}
								</v-sheet>
							</v-col>
							<v-col>
								<v-sheet class="pa-2 ma-2">
									<v-btn color="info" variant="outlined" class="mr-2" v-bind:href="'https://www.google.com/maps/search/?api=1&query='+employeeDetail.employee.latitude+','+employeeDetail.employee.longitude" target="_blank">
										Ver en google maps
									</v-btn>
								<a href="" target="_blank" rel="noopener noreferrer"></a>
								</v-sheet>
							</v-col>
						</v-row>
					</v-container>
				</v-card-text>
				<v-card-subtitle>
					Skills <v-icon class="ml-2" @click="addSkills = true">mdi-plus-thick</v-icon>
					<EmployeeAddSkillDialog v-model="addSkills"  :user_id="employeeDetail.employee.id" @success="verDetallesEmpleado( employeeDetail.employee)"/>
				</v-card-subtitle>
				<v-card-text>
					<v-btn class="text-none bg-blue pr-2 mr-2 mt-2" style="height: auto;" v-for="skill in employeeDetail.skills"
						:key="skill.id" size="small">
						{{ skill.name }}
						<v-rating v-model="skill.expertice" density="compact" />
					</v-btn>
				</v-card-text>
			</v-card>
		</v-dialog>
	</v-row>
</template>

<style lang="scss" scoped></style>