/*
 * Npm import
 */
import { createStore, applyMiddleware, compose } from 'redux';

/*
 * Local import
 */
// Reducer
import reducers from './reducers';

import socket from './middlewares/socket';
/*
 * Code
 */
const devTools = [];
if (window.devToolsExtension) {
  devTools.push(window.devToolsExtension());
}

const appliedMiddleware = applyMiddleware(socket);
const enhancers = compose(appliedMiddleware, ...devTools);

// createStore
const store = createStore(reducers, enhancers);


// // createStore
// const store = createStore(reducers, ...devTools);

/*
 * Export
 */
export default store;
