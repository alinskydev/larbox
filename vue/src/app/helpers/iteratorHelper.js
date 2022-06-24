export default {
    searchByPath(object, path, separator = '.') {
        let paths = path.split(separator),
            current = object;

        for (let i = 0; i < paths.length; ++i) {
            if (current === undefined || current[paths[i]] === undefined) {
                return undefined;
            } else {
                current = current[paths[i]];
            }
        }

        return current;
    },
};