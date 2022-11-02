export default {
    login(context, username, password) {
        password = password === '' ? localStorage.getItem('auth_password') : password;

        context.booted.config.http.headers['Authorization'] = 'Basic ' + window.btoa(username + ':' + password);
        localStorage.setItem('auth_username', username);
        localStorage.setItem('auth_password', password);
    },
    logout(context) {
        context.booted.config.http.headers['Authorization'] = null;
        localStorage.removeItem('auth_username');
        localStorage.removeItem('auth_password');
    },

    checkRoute(context, routeName) {
        // Checking route availability

        let routes = context.booted.enums.user.role.routes.list,
            userRoutes = context.booted.user.role.routes;

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
    },
};
