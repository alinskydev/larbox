import App from '@/core/app';

export default class {
    login(token) {
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

    checkRoute(routeName) {
        // Checking route availability

        let routes = App.enums.user_role.routes.list,
            userRoutes = App.user.role.routes;

        routeName = 'admin.' + routeName.replaceAll('/', '.');

        if (!routes.includes(routeName) || userRoutes.includes(routeName)) return true;

        // Checking route availability by asterisks

        let routeNameArr = routeName.split('.');

        for (let i = 0; i < routeNameArr.length; i++) {
            routeName = routeNameArr.slice(0, i);
            routeName = routeName ? routeName.join('.') + '.*' : '*';

            if (userRoutes.includes(routeName)) return true;
        }

        return false;
    }
}
