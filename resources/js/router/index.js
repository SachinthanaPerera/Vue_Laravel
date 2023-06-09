import {createRouter, createWebHistory} from "vue-router";
//admin
import homeAdminIndex from '../components/admin/home/index.vue'
import adminAboutIndex from '../components/admin/about/index.vue'
import adminPatientIndex from '../components/admin/patients/index.vue'
import adminPrescriptionsIndex from '../components/admin/prescriptions/index.vue'
// pages
import homePageIndex from '../components/pages/home/index.vue'
import notFound from '../components/notFound.vue'
import login from '../components/auth/login.vue'
const routes =[
// admin
{
    path:'/admin/home',
    name:'adminHome',
    component:homeAdminIndex,
    meta:{
        requiresAuth:true
    }
},
// about
{
    path:'/admin/about',
    name:'adminAbout',
    component:adminAboutIndex,
    meta:{
        requiresAuth:true
    }
},
// patients
{
    path:'/admin/patients',
    name:'adminPatient',
    component:adminPatientIndex,
    meta:{
        requiresAuth:true
    }
},
// prescriptions
{
    path:'/admin/prescriptions',
    name:'adminPrescription',
    component:adminPrescriptionsIndex,
    meta:{
        requiresAuth:true
    }
},
// Pages
{
    path:'/',
    name:'Home',
    component:homePageIndex,
    meta:{
        requiresAuth:false
    }
},
//login
{
    path:'/login',
    name: 'Login',
    component:login,
    meta:{
        requiresAuth:false
    }
},
// notFound
{
    path:'/:pathMatch(.*)*',
    name:'notFound',
    component:notFound,
    meta:{
        requiresAuth:false
    }
}
]
const router = createRouter({
    history: createWebHistory(),
    routes,
})
router.beforeEach((to, from) =>{
    if(to.meta.requiresAuth && !localStorage.getItem('token')){
        return {name: 'Login'}
    }
    if(to.meta.requiresAuth == false && localStorage.getItem('token')){
        return {name: 'adminHome'}
            }
})
export default router
