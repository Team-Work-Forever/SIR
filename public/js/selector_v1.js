class SelectorItem {
  constructor(title, selected = false, url = undefined) {
    this.url = url;
    this.title = title;
    this.selected = selected;

    this.html = this.init();
  }

  init() {
    const selectorElement = document.createElement("div");
    selectorElement.classList.add("selector-element");
    selectorElement.innerHTML = this.title;

    return selectorElement;
  }

  toggle() {
    this.selected = !this.selected;

    if (this.selected) {
      this.html.classList.add("active");
      this.url?.searchParams.append(this.title, true);
    } else {
      this.html.classList.remove("active");
      this.url?.searchParams.delete(this.title);
    }

    if (this.url) {
      window.location.href = this.url.href;
    }
  }
}

class Selector {
  constructor() {
    this.items = [];
    this.url = new URL(window.location.href);

    this.selector = document.getElementById("selector");
    const options = JSON.parse(this.selector.dataset.mcCategories);

    // add selectors and init the Todos selector
    this.addSelector(new SelectorItem("Todos"));

    options.forEach((option) => {
      this.addSelector(new SelectorItem(option.name, false, this.url));
    });

    // If there is a query string, select the items
    this.url.searchParams.forEach((value, key) => {
      const item = this.getElementByTitle(key);
      item.selected = true;
      item.html.classList.add("active");
    });

    if (this.url.searchParams.size === 0) {
      this.items[0].toggle();
    }
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
      this.url.searchParams.delete(item.title);

      window.location.href = this.url.href;
    });
  }

  toggleAll() {
    this.items.forEach((item) => {
      item.selected = true;
      item.html.classList.add("active");
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

        // If all elements are selected, select the first one
        if (this.items.slice(1).every((item) => item.selected)) {
          this.items.forEach((item) => {
            if (item.selected) {
              item.toggle();
            }
          });

          this.items[0].toggle();
        }
      }
    });
  }

  isFirstSelected() {
    return this.items[0].selected;
  }
}

new Selector().listen();
