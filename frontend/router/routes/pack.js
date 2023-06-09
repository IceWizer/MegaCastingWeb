export default [
    {
        path: '/packs/',
        name: 'pack-list',
        component: () => import('../../views/pack/List.vue'),
        meta: {
            requiresAuth: false,
            redirectIfLoggedIn: false,
            layout: 'default'
        }
    }
]
