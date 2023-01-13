export default class {
    get(object, path = '', separator = '.') {
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
                            return current.map((value) => this.get(value, newPath));
                        case 'object':
                            return Object.fromEntries(
                                Object.entries(current).map((entry) => {
                                    entry[1] = this.get(entry[1], newPath);
                                    return entry;
                                }),
                            );
                    }
                } else {
                    current = current[paths[i]];
                }
            }
        }

        return current;
    }
}
