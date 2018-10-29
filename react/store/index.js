/*
 * Npm import
 */
import { createStore, applyMiddleware, compose } from 'redux';

/*
 * Local import
 */
// Reducer
import reducers from './reducers';

// Middleware
import socket from './middlewares/socket';
import axiosMiddleware from './middlewares/axiosMiddleware';
/*
 * Code
 */
const devTools = [];
if (window.devToolsExtension) {
  devTools.push(window.devToolsExtension());
}

const appliedMiddleware = applyMiddleware(socket, axiosMiddleware);
const enhancers = compose(appliedMiddleware, ...devTools);

// createStore
const store = createStore(reducers, enhancers);


// // createStore
// const store = createStore(reducers, ...devTools);

/*
 * Export
 */
export default store;
