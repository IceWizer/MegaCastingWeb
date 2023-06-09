const tabs = [
    {
        title: 'Accueil',
        routeName: 'dashboard',
        icon: 'HouseFill',
    },
    {
        title: 'Packs',
        routeName: 'pack-list',
        icon: 'Boxes',
    },
    {
        title: 'Mon profil',
        routeName: 'profil',
        icon: 'PersonCircle',
        security: ['FULLY_AUTHENTICATED'],
        securityOperator: 'AND'
    },
    {
        title: 'Nous rejoindre',
        routeName: 'register',
        security: ['NOT_FULLY_AUTHENTICATED'],
        securityOperator: 'AND'
    },
    {
        title: 'Se connecter',
        routeName: 'login',
        security: ['NOT_FULLY_AUTHENTICATED'],
        securityOperator: 'AND'
    },
    {
        title: 'Se déconnecter',
        routeName: 'logout',
        security: ['FULLY_AUTHENTICATED'],
        securityOperator: 'AND'
    }
]

export default () => tabs
