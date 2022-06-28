export default {
    searchByPath(object, path, separator = '.') {
        let paths = path.split(separator),
            current = object;

        if (path === '') return current;

        for (let i = 0; i < paths.length; ++i) {
            if (current === undefined || current === null) {
                return undefined;
            } else {
                if (paths[i] === '*') {
                    let newPath = paths.slice(i + 1, paths.length).join('.');

                    switch (typeof current) {
                        case 'array':
                            return current.map((value) => this.searchByPath(value, newPath));
                        case 'object':
                            return Object.values(current).map((value) => this.searchByPath(value, newPath));
                    }
                } else {
                    current = current[paths[i]];
                }
            }
        }

        return current;
    },
};