class SelectorItem {
  constructor(title, selected = false) {
    this.title = title;
    this.selected = selected;

    this.html = this.init();
    this.toggle(this.selected);
  }

  init() {
    const selectorElement = document.createElement("div");
    selectorElement.classList.add("selector-element");
    selectorElement.innerHTML = this.title;

    return selectorElement;
  }

  toggle(selected) {
    this.selected = selected ?? !this.selected;

    if (this.selected) {
      this.html.classList.add("active");
    } else {
      this.html.classList.remove("active");
    }
  }
}

class Selector {
  constructor(options) {
    this.items = [];
    this.selector = document.getElementById("selector");

    // add selectors and init the Todos selector
    this.addSelector(new SelectorItem("Todos", true));
    options.forEach((option) => {
      this.addSelector(new SelectorItem(option));
    });
  }

  addSelector(item) {
    this.items.push(item);
    this.selector.appendChild(item.html);
  }

  getElementByTitle(title) {
    return this.items.find((item) => item.title === title);
  }

  unToggleAll() {
    this.items.forEach((item) => {
      item.selected = false;
      item.html.classList.remove("active");
    });
  }

  listen() {
    this.selector.addEventListener("click", (event) => {
      const element = event.target;
      const title = element.innerHTML;
      const item = this.getElementByTitle(title);

      if (element.classList.contains("selector-element") && item) {
        const isPreviousSelected = item.selected;

        // If the first is selected an is to be selected again, do nothing
        if (isPreviousSelected && this.isFirstSelected()) {
          return;
        }

        // select the item
        item.toggle();

        // TUDO selecionado
        if (this.isFirstSelected()) {
          this.unToggleAll();
          return item.toggle();
        }

        // If the first item is selected, unselect all others
      }
    });
  }

  isFirstSelected() {
    return this.items[0].selected;
  }
}

new Selector(["Carne", "Adeus", "Boa Noite"]).listen();
