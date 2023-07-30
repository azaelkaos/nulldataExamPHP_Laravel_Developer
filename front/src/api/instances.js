export const baseInstanceGet = async (endpoint)=>{
	const requestOptions = {
		method: 'GET',
		mode:"cors",
		headers:{
			"Accept": "application/json",
			"Content-Type":"application/json"
		},
		redirect: 'follow',
		referrerPolicy:"no-referrer",
	};
	const apiUrl=import.meta.env.VITE_API_URL
	const response = await fetch(apiUrl+'/'+endpoint,requestOptions);
	const responseData = await response.json()
	return responseData
}
export const baseInstancePost = async (endpoint,bodyJson)=>{
	const requestOptions = {
		method: 'POST',
		mode:"cors",
		headers:{
			"Accept": "application/json",
			"Content-Type":"application/json"
		},
		redirect: 'follow',
		referrerPolicy:"no-referrer",
		body: JSON.stringify(bodyJson)
	};
	const apiUrl=import.meta.env.VITE_API_URL
	const response = await fetch(apiUrl+'/'+endpoint,requestOptions);
	const responseData = await response.json()
	return responseData
}