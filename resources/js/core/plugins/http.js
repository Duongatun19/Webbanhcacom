import axios from 'axios';

import CONSTANTS from '../utils/constants';
const token = localStorage.getItem(CONSTANTS.ACCESS_TOKEN);

export const HTTP = axios.create({
  baseURL: __ENV__.link,
  headers: {
    Authorization: 'Bearer '+token
  }
})