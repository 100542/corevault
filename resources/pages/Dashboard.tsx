import React from "react";
import ReactDOM from "react-dom/client";
import Dashboard from '../ts/components/Dashboard';
import "../css/app.css"

const App: React.FC = () => {
    return (
        <>
            <Dashboard />
        </>
    );
};

const container = document.getElementById("app");
if (container) {
    ReactDOM.createRoot(container).render(<App />);
}
