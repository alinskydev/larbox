export default class {
    uniqueId() {
        return new Date().getTime().toString() + Math.random().toString().substring(2);
    }

    uniqueElementId() {
        return 'el-' + this.uniqueId();
    }
}
