export default [
    {
        path: '/casting-offers/:id',
        name: 'casting-offers-item',
        component: () => import('../../views/casting-offers/Show.vue'),
        meta: {
            requiresAuth: false,
            redirectIfLoggedIn: false,
            layout: 'default'
        }
    }
]
