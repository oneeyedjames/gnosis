const drawer = mdc.drawer.MDCDrawer.attachTo(document.getElementById('nav-drawer'));
const topAppBar = mdc.topAppBar.MDCTopAppBar.attachTo(document.getElementById('app-bar'));

topAppBar.setScrollTarget(document.getElementById('main-content'));
topAppBar.listen('MDCTopAppBar:nav', () => drawer.open = !drawer.open);
