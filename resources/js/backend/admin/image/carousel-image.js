
// Vue components Export

import CustomAlert from '../components/CustomAlert.vue'
const alert = createApp(CustomAlert);
const alertInstance = alert.mount('#alert')

// function

let notification;

$(document).ready(function(){

    if(localStorage.getItem(notification)){
        alertInstance.updateMessage(localStorage.getItem(notification))
        alertInstance.autoAlert();
        localStorage.clear();
    }

    let draggableImageInstances = [];
    let draggablePanelArea = [];

    const form = $('form.form')

    // create instance
    $('.image-box').each(function () {
        let draggableImage = new DraggableImage(this);
        draggableImageInstances.push(draggableImage);
    });

    // create instance
    $('.image-container').each(function () {
        let panelArea = new PanelArea(this);
        draggablePanelArea.push(panelArea);
    });

    let fileInput = $('input.upload-image');

    fileInput.change(() => {
        form.submit();
    });


})

// Global Variable

let draggedImageId = null;

// Class Define

class DraggableImage{

    element;
    id;
    self;

    constructor(element){

        // Define variable
        this.element = element;
        this.id =  $(this.element).data('id')
        this.self = this;

        this.createCloseButton();
        this.initInstance();
    }

    /**
     *  Init the instance method
     */

    initInstance(){

        // Dragstart
        this.element.addEventListener('dragstart', (event)=>{this.setImageData(event)});
    
    }

    setImageData(event){
        draggedImageId = this.id;
    }

    /**
     *  Static method
     */

    static resetDraggableImage(clonedImage ,relationPath){

        clonedImage[0].addEventListener('dragstart', function(event) {
            this.path = relationPath;
            draggedImageId = $(this).data('id');
        });
    }

    createCloseButton(){
        // 创建一个新的 div 元素，作为关闭按钮
        const closeButton = $('<div>')
            .addClass('delete-button')
                .append($('<i>')
                .addClass('fa-solid fa-xmark'));

        closeButton.dblclick(this.deleteImage)

        // 将关闭按钮添加到当前元素
        $(this.element).find('img.image-preview').after(closeButton);
    }

    deleteImage = () =>{

        let relationPath = $(this.element).find('img.image-preview').data('path');
        let sourcePanel = $(this.element).closest('section.panel').data('panel');

        console.log(sourcePanel)

        let request = new AjaxAPI;
        request.sentData(
            '/admin/image/carousel-image-delete',
            {
                'relationPath': relationPath,
                'sourcePanel': sourcePanel,
            }
        )
    }

}

class PanelArea{

    element;

    constructor(element){

        // Define variable
        this.element = element;

        // Init Method
        this.initInstance();
    }

    initInstance(){

        // Dragenter
        this.element.addEventListener('dragenter', (event)=>{this.toggleClass(event)});

        // Dragover
        this.element.addEventListener('dragover', (event)=>{this.stopDefaultMethod(event)});

        // Dragleave
        this.element.addEventListener('dragleave', (event)=>{this.toggleClass(event)});

        // Drop
        this.element.addEventListener('drop', (event)=>{this.dropOnTarget(event)});
    }

    stopDefaultMethod(event){
        event.preventDefault();
        event.dataTransfer.dropEffect = 'move'; 
    }

    dropOnTarget(event){
        let draggedImage = $('.image-box[data-id="' + draggedImageId + '"]');
        let clonedImage = draggedImage.clone();
        $(this.element).append(clonedImage);

        let relationPath = $(clonedImage[0]).find('img.image-preview').data('path');
        let targetPanel = $(this.element).parent().data('panel');
        let fullName =  $(clonedImage[0]).find('p.image-name').text();

        // sent ImageData to ajax
        let request = new AjaxAPI();
        request.sentData(
            '/admin/image/carousel-image-update',
            {
                'relationPath': relationPath,
                'targetPanel': targetPanel,
                'fullName': fullName,
            }
        );

        // reset the image selector
        DraggableImage.resetDraggableImage(clonedImage, relationPath);

        // reset status, variable
        draggedImage.remove();
        draggedImageId = null;
        $(this.element).removeClass('active')
        clonedImage = null;
    }

    toggleClass(event){
        event.preventDefault();
        $(this.element).toggleClass('active')
    }

}

// API

class AjaxAPI{

    /**
     * @function constructor - Init Ajax Request
     * @param {string} url
     * @param {JSON} data - data you want to sent
     */

    constructor(){
        
    }

    sentData(url, data, refresh=true){

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            dataType: 'html',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                let LocalS = localStorage.setItem(notification, 'Successful Update!')
                if(refresh){
                    location.reload()
                }
                console.log(data);
            },
            error: function(xhr, status, error) {
                let LocalS = localStorage.setItem(notification, 'That have something happen !')
                console.log(xhr.responseText);
            }
        });

    }

}