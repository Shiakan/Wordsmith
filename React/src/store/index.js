/*
 * Npm import
 */
import { createStore } from 'redux';

/*
 * Local import
 */
// Reducer
import reducers from 'src/store/reducers';

/*
 * Code
 */
const devTools = [];
if (window.devToolsExtension) {
  devTools.push(window.devToolsExtension());
}

// createStore
const store = createStore(reducers, ...devTools);

/*
 * Export
 */
export default store;
