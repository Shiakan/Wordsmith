/**
 * NPM import
 */
import 'babel-polyfill';
import React from 'react';
import { render } from 'react-dom';
import { Provider } from 'react-redux';

/**
 * Local import
 */
import App from './components/App';
// // store
import store from './store';

/**
 * Code
 */
const test = document.getElementById('root');

const rootComponent = (
  <Provider store={store}>
    <App {...(test.dataset)} />
  </Provider>
);

render(rootComponent, test);
