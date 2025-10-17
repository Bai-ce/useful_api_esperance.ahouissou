import { ref, computed } from 'vue'
import { defineStore } from 'pinia'
// import axios from 'axios'

export const useAuthStore = defineStore('auth', () => {
  const user = ref(null)

  const register = async (newUser) => {
    try {
      // await axios.get('/sanctum/csrf-cookie')
      const response = await fetch('http://localhost:8000/api/register', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          'Access-Control-Allow-Origin': '*',
          'Access-Control-Allow-Credentials': true,
        },
        body: JSON.stringify(newUser),
      })
      if (!response.ok) {
        console.log('error')
      } else {
        user.value = newUser
        console.log('success')
      }
    } catch (err) {
      console.log(err.message)
    }
  }

  const login = async (data) => {
    try {
      const response = await fetch('http://localhost:8000/api/login', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          'Access-Control-Allow-Origin': '*',
          'Access-Control-Allow-Credentials': true,
        },
        body: JSON.stringify(data),
      })
      if (!response.ok) {
        console.log('error')
      } else {
        console.log('success')
        $token = response.data
        console.log($token)
        localStorage.setItem('token', $token)
      }
    } catch (err) {
      console.log(err.message)
    }
  }
  return { login, register }
})
