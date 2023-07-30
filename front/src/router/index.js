import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      redirect:()=>({name:'employees'}),
      component: ()=> import('../layouts/DashboardLayout.vue'),
      children:[
        {
          path: "employees",
          name: "employees",
          component: () => import("../views/EmployeesView.vue"),
        }
      ]
    }
  ]
})

router.beforeEach((_to, _from, next) => {
  next()
})

export default router
