
$(document).ready(function() {
    // 阻止默认的拖放行为
    $('.image-box').on('dragstart', function(event) {
        let dataId = $(this).data('id');
        event.originalEvent.dataTransfer.setData('text/plain', dataId);
    });

    // 给拖放容器绑定事件
    $('.image-container').on('dragover', function(event) {
        event.preventDefault();
    });

    // 给拖放容器绑定事件
    $('.image-container').on('drop', function(event) {
        event.preventDefault();
        
        // 获取拖动的图片元素的ID
        var imageId = event.originalEvent.dataTransfer.getData('text/plain');
        // 获取拖动的图片元素
        var draggedImage = $('.image-box[data-id="' + imageId + '"]');
        
        // 克隆拖动的图片并添加到当前容器中
        var clonedImage = draggedImage.clone();
        console.log(clonedImage);
        $(this).append(clonedImage);

        // 移除原始的拖动图片
        draggedImage.remove();
    });
});



// Class Define

class DraggableImage{

    element;

    constructor(element){

        // Define variable
        this.element = element;

        // Init Method
        this.addEventListener('')

    }

}

class PanelArea{

    element;

    constructor(element){

        // Define variable
        this.element = element;

        // Init Method
        this.addEventListener('')

    }
}