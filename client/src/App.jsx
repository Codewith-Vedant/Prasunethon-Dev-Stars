import Signup from './pages/signup'

import Login from './pages/login'
import { BrowserRouter, Routes, Route } from 'react-router-dom'

function App() {
  

  return (
    <BrowserRouter>
    <Routes>
      <Route path="/signup" element={<Signup/>} />
      <Route path="/login" element={<Login/>} />
    </Routes>
      
    </BrowserRouter>
  )
}

export default App
