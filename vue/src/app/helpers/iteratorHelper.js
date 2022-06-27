export default {
    searchByPath(object, path, separator = '.') {
        let paths = path.split(separator),
            current = object;

        for (let i = 0; i < paths.length; ++i) {
            if (current === undefined || current === null || current[paths[i]] === undefined || current[paths[i]] === null) {
                return undefined;
            } else {
                current = current[paths[i]];
            }
        }

        return current;
    },
};