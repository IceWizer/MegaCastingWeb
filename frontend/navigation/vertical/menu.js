const tabs = [
    {
        title: 'Dashboard',
        routeName: 'dashboard',
        icon: 'HouseFill',
    },
    {
        title: 'Mon profil',
        routeName: 'profil',
        icon: 'PersonCircle',
        security: ['FULLY_AUTHENTICATED'],
        securityOperator: 'AND'
    },
    {
        title: 'Connexion',
        icon: 'HouseFill',
        children: [
            {
                title: 'Register',
                routeName: 'register',
                security: ['NOT_FULLY_AUTHENTICATED'],
                securityOperator: 'AND'
            },
            {
                title: 'Login',
                routeName: 'login',
                security: ['NOT_FULLY_AUTHENTICATED'],
                securityOperator: 'AND'
            },
            {
                title: 'Logout',
                routeName: 'logout',
                security: ['FULLY_AUTHENTICATED'],
                securityOperator: 'AND'
            }
        ]
    }
]

export default () => tabs
