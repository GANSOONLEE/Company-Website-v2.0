
/**
 * 
 * ----------------------------------------
 *  Import 
 * ----------------------------------------
 * 
 */

import ContainFilter from './ContainFilter.js'
import StrictFilter from './StrictFilter.js'
import BeginFilter from './BeginFilter.js'
import EndFilter from './EndFilter.js'

import FilterElementFactory from '../edit-product.js'

export default class FilterFactory{

    method;
    element;
    column;

    /**
     * 
     * @param {string} method 
     * @param {element} element 
     */

    constructor(element, method, column, trigger){
        this.element = element;
        this.method = method;
        this.column = column;

        return this.triggerListener(trigger);
    }

    triggerListener(trigger){

        this.element.addEventListener(trigger, ()=>{
            let value = this.element.value;
            let result = this.initFilterEvent(value);
        })

    }


    initFilterEvent(value){
        let method = this.method;
        let element = this.element;
        let column = this.column;

        switch(method){

            case 'contain':
                return new ContainFilter(value, column);
                
            case 'strict':
                return new StrictFilter(value, column);

            default:
                console.error('Something Wrong!')
                return;
        }
    }


}