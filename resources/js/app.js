// import React from 'react';
// import ReactDOM from 'react-dom/client';
// import { BrowserRouter } from 'react-router-dom';
// import Dashboard from './components/Dashboard';
// import OrganizationsPage from './components/OrganizationsPage';
// import 'bootstrap/dist/css/bootstrap.min.css';

// // Render Dashboard to root element
// if (document.getElementById('root')) {
//     const root = ReactDOM.createRoot(document.getElementById('root'));
//     root.render(
//         <BrowserRouter>
//             <Dashboard />
//         </BrowserRouter>
//     );
// }

// // Render OrganizationsPage to org-root element
// if (document.getElementById('org-root')) {
//     const orgRoot = ReactDOM.createRoot(document.getElementById('org-root'));
//     orgRoot.render(
//         <BrowserRouter>
//             <OrganizationsPage />
//         </BrowserRouter>
//     );
// }

import React from 'react';
import { createRoot } from 'react-dom/client';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import Dashboard from './components/Dashboard';
import OrganizationsPage from './components/OrganizationsPage';
import 'bootstrap/dist/css/bootstrap.min.css';

const App = () => {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/user/dashboard" element={<Dashboard />} />
        <Route path="/organizations" element={<OrganizationsPage />} />
      </Routes>
    </BrowserRouter>
  );
};

const root = createRoot(document.getElementById('root'));
root.render(<App />);

