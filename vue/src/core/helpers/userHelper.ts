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
        let checkableRoutes = App.enums.User.Role.RoutesList,
            userRoutes = App.user.role.routes;

        routeName = 'admin.' + routeName.replaceAll('/', '.');

        return !checkableRoutes.includes(routeName) || userRoutes.includes(routeName);
    }
}
