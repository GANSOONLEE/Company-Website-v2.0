
export default class Filter {
    element;
    mode;
    trigger;
    changeCallback; // 用于处理过滤器值变化的回调函数

    constructor(element, mode, trigger = "change") {
        this.element = element;
        this.mode = mode;
        this.trigger = trigger;

        this.initFilter();

        // 添加事件监听器
        this.element.addEventListener(this.trigger, () => {
            if (typeof this.changeCallback === 'function') {
                this.changeCallback(this.getValue());
            }
        });
    }

    initFilter() {
        // Define temporary variables
        let mode = this.mode;
        let element = this.element;
        let filter;
        let result;

        // Verify parameter validation
        const availableMode = ["contain", "strict"];
        if(!availableMode.includes(mode)){
            console.error(`The mode "${mode}" is unavailable`);
            console.error(`The available mode have ${availableMode}`);
            return false;
        }

    }

    getMode() {
        return this.mode;
    }

    getValue() {
        return this.element.value;
    }

    setChangeCallback(callback) {
        this.changeCallback = callback;
    }
}
