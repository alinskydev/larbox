export default {
    login(context, token) {
        context.booted.config.http.headers['Authorization'] = token;
        localStorage.setItem('authToken', token);
    },
    logout(context) {
        context.booted.config.http.headers['Authorization'] = null;
        localStorage.removeItem('authToken');

        context.$router.push({
            path: '/' + context.booted.locale + '/auth/login',
        });
    },

    checkRoute(context, routeName) {
        // Checking route availability

        let routes = context.booted.enums.user_role.routes.list,
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
