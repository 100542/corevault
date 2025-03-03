import React from "react";
import ReactDOM from "react-dom/client";
import Waves from "../ts/components/Waves";
import Index from '../ts/components/Index'

const App: React.FC = () => {
    return (
        <>
            <Waves
                lineColor="#7A918D"
                backgroundColor="rgba(23, 22, 20)"
                waveSpeedX={0.02}
                waveSpeedY={0.01}
                waveAmpX={40}
                waveAmpY={20}
                friction={0.9}
                tension={0.01}
                maxCursorMove={120}
                xGap={12}
                yGap={36}
            />
            <Index />
        </>
    );
};

const container = document.getElementById("app");
if (container) {
    ReactDOM.createRoot(container).render(<App />);
}
