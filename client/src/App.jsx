import Solo_Signup from './pages/solo_signup'
import Company_Signup from './pages/company_signup'
import Login from './pages/login'
import { BrowserRouter, Routes, Route } from 'react-router-dom'

function App() {
  

  return (
    <BrowserRouter>
    <Routes>
      <Route path="/solo_signup" element={<Solo_Signup/>} />
      <Route path="/company_signup" element={<Company_Signup/>} />
      <Route path="/login" element={<Login/>} />
    </Routes>
      
    </BrowserRouter>
  )
}

export default App
