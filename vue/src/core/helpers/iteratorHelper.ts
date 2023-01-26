export default class {
    get(object: Object | Array<any>, path: any, separator = '.'): any {
        if (!path) return object;

        let pathArr = path.split(separator);

        for (let i = 0; i < pathArr.length; ++i) {
            if (object === undefined || object === null) return object;

            if (pathArr[i] === '*') {
                let newPath = pathArr.slice(i + 1, pathArr.length).join('.');

                return Object.fromEntries(
                    Object.entries(object).map((entry) => {
                        entry[1] = this.get(entry[1], newPath);
                        return entry;
                    }),
                );
            }

            object = object[pathArr[i]];
        }

        return object;
    }
}
