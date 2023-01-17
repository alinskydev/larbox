import App from '@/core/app';

export default class {
    login(token: string) {
        App.config.http.headers['Authorization'] = token;
        localStorage.setItem('authToken', token);
    }

    logout() {
        App.config.http.headers['Authorization'] = null;
        localStorage.removeItem('authToken');

        App.components.app.$router.push('/' + App.locale + '/auth/login').then(() => {
            App.components.app.refresh();
        });
    }

    checkRoute(routeName: string) {
        routeName = 'admin.' + routeName.replaceAll('/', '.');

        let checkableRoutes = App.enums.user_role.routes.list,
            userRoutes = App.user.role.routes;

        if (!checkableRoutes.includes(routeName) || userRoutes.includes(routeName)) return true;

        // Checking route availability by asterisks

        let routeNameArr = routeName.split('.'),
            routeNameWithAsterisk;

        for (let i = 0; i < routeNameArr.length; i++) {
            routeNameWithAsterisk = routeNameArr.slice(0, i);
            routeNameWithAsterisk = routeNameWithAsterisk.length > 0 ? routeNameWithAsterisk.join('.') + '.*' : '*';

            if (userRoutes.includes(routeNameWithAsterisk)) return true;
        }

        return false;
    }
}
