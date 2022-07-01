export default {
    uniqueId() {
        return new Date().getTime().toString() + Math.random().toString().substring(2);
    },
};