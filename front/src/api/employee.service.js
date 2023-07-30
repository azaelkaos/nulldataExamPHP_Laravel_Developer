import { baseInstanceGet, baseInstancePost } from "./instances";
// import { baseInstancePost } from "./instances";

export const getEmpoyeeList = async ()=>{
  return  baseInstanceGet('empleado/list')
} 

export const getEmpoyeeDetail = async (id)=>{
  return  baseInstanceGet('empleado/read?id='+id)
} 
export const addEmployee = async(body)=>{
	return baseInstancePost('empleado/create',body)
}

export const addSkillToEmployee = async(body)=>{
	return baseInstancePost('skill/create',body)
}
