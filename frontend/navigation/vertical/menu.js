const tabs = [
    {
        title: 'Dashboard',
        routeName: 'dashboard',
        icon: 'HouseFill',
        children: [
            {
                title: 'Analytics',
                routeName: 'dashboard-analytics',
            },
            {
                title: 'Ecommerce',
                routeName: 'dashboard-ecommerce',
            },
        ]
    },
    {
        title: 'test',
        icon: 'HouseFill',
        children: [
            {
                title: 'Register',
                routeName: 'register',
            },
            {
                title: 'Login',
                routeName: 'login',
            },
            {
                title: 'Logout',
                routeName: 'logout',
            }
        ]
    }
]

export default () => tabs
