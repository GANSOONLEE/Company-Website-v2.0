
/**
 * 
 * ----------------------------------------
 *  Import 
 * ----------------------------------------
 * 
 */

import ContainFilterFactory from './ContainFilterFactory.js'
import StrictFilterFactory from './StrictFilterFactory.js'
import BeginFilterFactory from './BeginFilterFactory.js'
import EndFilterFactory from './EndFilterFactory.js'

export default class FilterFactory{

    method;
    element;

    /**
     * 
     * @param {string} method 
     * @param {element} element 
     */

    constructor(method, element){
        this.method = method;
        this.element = element;

        this.changeListener();
    }

    changeListener(){

        this.element.addEventListener('change', ()=>{
            let value = this.element.value;
            this.initFilterEvent(value);
            console.log(value)
        })

    }


    initFilterEvent(value){
        let method = this.method;
        let element = this.element;

        switch(method){

            case 'contain':
                new ContainFilterFactory(element, value);
                return value;
                
            case 'strict':
                new StrictFilterFactory(element, value);
                return value;

            case 'begin':
                new BeginFilterFactory(element, value);
                return value;

            case 'end':
                new EndFilterFactory(element, value);
                return value;

        }
    }


}