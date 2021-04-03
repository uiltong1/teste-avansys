import axios from 'axios'

export const http = axios.create({
  baseURL: process.env.VUE_APP_ROOT_API
})

// http.interceptors.request.use(async (config) => {
//   try {
//     const token = await sessionStorage.token

//     if (token) {
//       config.headers.Authorization = `Bearer ${token}`
//     }
//     return config
//   } catch (error) {
//     console.log(error)
//   }
// })
