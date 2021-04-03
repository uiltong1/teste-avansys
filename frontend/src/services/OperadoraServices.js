import { http } from './config'

export default {
  get: () => {
    return http.get('operadoras')
  },
  post: (params) => {
    return http.post('operadoras', params)
  },
  update: (id, params) => {
    return http.put(`operadoras/${id}`, params)
  },
  toggle: (param) => {
    return http.put(`operadoras/${param}/toggle`)
  },
  search: (params) => {
    return http.get('operadoras_search', { params })
  },
  delete: (params) => {
    return http.delete(`operadoras`, { params })
  }
}
