export default [
    {
        path: '/profil',
        name: 'profil',
        component: () => import('@/views/profil/Profil.vue'),
        meta: {
            requiresAuth: true,
            redirectIfLoggedIn: true,
            layout: 'default'
        }
    }
]
