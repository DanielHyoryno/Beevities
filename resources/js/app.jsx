import React from 'react';
import { createRoot } from 'react-dom/client';
import { BrowserRouter } from 'react-router-dom';
import Dashboard from './components/Dashboard';
import OrganizationsPage from './components/OrganizationsPage';

console.log('app.jsx loaded');

const root = document.getElementById('dashboard-root');
if (root) {
    console.log('Rendering Dashboard at dashboard-root');
    createRoot(root).render(
        <BrowserRouter>
            <Dashboard />
        </BrowserRouter>
    );
} else {
    console.log('dashboard-root not found');
}

const orgRoot = document.getElementById('org-root');
if (orgRoot) {
    console.log('Rendering OrganizationsPage at org-root');
    createRoot(orgRoot).render(
        <BrowserRouter>
            <OrganizationsPage />
        </BrowserRouter>
    );
} else {
    console.log('org-root not found');
}