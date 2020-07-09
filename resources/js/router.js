import Vue from 'vue'
import Router from 'vue-router'
import requestList from './pages/admin/generateRequestList'
import createNewList from './pages/admin/InputListModel'

Vue.use(Router)

export default new Router({
    routes: [
        {
            path: "/admin/createNewList",
            name: "createNewList",
            component: createNewList
        },
        {
            path: '/admin/requestList',
            name: 'requestList',
            component: requestList
        }
    ]
})
