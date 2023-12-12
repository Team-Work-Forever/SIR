class SelectorFrame {
    html;
    selector;

    constructor(selector) {
        this.selector = selector;
    }

    create() {
        const newFrame = document.createElement('div');
        newFrame.className = 'selector-frame';

        this.html = this.selector.appendChild(newFrame);
        return this.html;
    }

    getHtml() {
        return this.html;
    }
}

let currentIndex = 0;
const elementWidth = 114;
const elementGap = 24;
const swipeLength = -(elementWidth + elementGap);

class SelectorItem {
    index;
    CLASS_NAME = "selector-element"

    selector;
    title;
    inlineFrame;

    selectorItem;

    constructor(index, selector, title) {
        this.index = index;
        this.selector = selector;
        this.title = title;

        this.selectorItem = this.create()
    }

    create() {
        const selectorElement = document.createElement('div');
        selectorElement.className = this.CLASS_NAME;
        selectorElement.innerHTML = this.title;

        this.selector.append(selectorElement);
        return selectorElement;
    }

    select(frame) {
        this.inlineFrame = frame.style.transform = `translateX(${-this.index * swipeLength}px)`;
    }

    unSelect() {
        inlineFrame = undefined;
    }

    getSelector() {
        return this.selectorItem;
    }
}

class Selector {
    items;
    html;

    frame;

    constructor(selectors) {
        this.items = [];
        this.html = document.getElementsByClassName('selector')[0];
        this.frame = this._createFrame();

        this.items.unshift(new SelectorItem(0, this.html, 'Todos'));

        selectors.forEach((item, index) => {
            this.items.unshift(new SelectorItem(index + 1, this.html, item));
        });
    }

    _createFrame() {
        const newFrame = document.createElement('div');
        newFrame.className = 'selector-frame';

        return this.html.appendChild(newFrame);
    }

    _unSelectAll() {
        this.items.forEach((item, index) => {
            if (index != 0) {
                item.unSelect()
            }
        });
    }

    listning() {
        this.items.forEach((item, index) => {
            item.getSelector().addEventListener('click', () => {
                item.select(this.frame);
            });
        });
    }
}

selector = new Selector([
    'Sobremesas',
    'Peixe',
    'Carne',
    'Vegetariano'
])

selector.listning();

// head = new SelectorItem(0, selector, 'Todos');

// frame = new SelectorFrame(selector)
// head.select(frame.create());

// const selectorItems = document.querySelectorAll('.selector-element')




// selectorItems.forEach((item, index) => {
//     item.addEventListener('click', () => {
//         const translateValue = -index * swipeLength;

//         // Select only one

//     });
// });

// function selectElement(element) {
//     selectorFrame = createFrame(index);
//     moveFrame(selectorFrame, translateValue);
// }

// function unselectElement() {
//     selectorFrame = createFrame(index);
//     moveFrame(selectorFrame, translateValue);
// }

// function moveFrame(selectorFrame, distance) {
//     selectorFrame.style.transform = `translateX(${distance}px)`;
// }

// function getFrame(index) {
//     const existingFrame = document.getElementById(frameId);

//     if (existingFrame) {
//         return existingFrame;
//     }
// }

// function createFrame(frameId) {
//     const newFrame = document.createElement('div');
//     newFrame.className = 'selector-frame';
//     newFrame.id = frameId;
//     return selector.appendChild(newFrame);
// }

// function createSelectorElement(title) {
//     const selectorElement = document.createElement('div');
//     selectorElement.className = 'selector-element';
//     selectorElement.innerHTML = title;

//     selector.insertBefore(selectorElement, selector.firstChild);

//     return selectorElement;
// }

