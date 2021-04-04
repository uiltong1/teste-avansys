import { http } from "./config";

export default {
  get: () => {
    return http.get("operadoras");
  },
  post: (params) => {
    return http.post("operadoras", params);
  },
  update: (id, params) => {
    return http.put(`operadoras/${id}`, params);
  },
  search: (params) => {
    return http.get("operadoras_search", { params });
  },
  toggle: (params) => {
    return http.patch("operadoras/toggle", params); 
  },
  delete: (params) => {
    return http.patch("operadoras/delete", params); 
  },
};
