import Navigation from "./Navigation";

export default function Dashboard() {
    return (
        <>
            <Navigation />
            <div className="flex flex-col min-h-screen bg-gray-800">
            <div className="w-full h-40 bg-gray-700 flex flex-row items-center">
                        <h1 className="p-4 text-6xl font-bold text-white">Welcome Back, Testgebruiker!</h1>
                    </div>
                <div className="relative z-10 flex flex-col p-16 space-y-4">
                    <div className="flex flex-row gap-10">
                        <div className="bg-gray-700 rounded-md padding-4 w-[30%] min-h-40 flex flex-col">
                            <h2 className="text-3xl font-bold text-white p-2">
                                Your investments
                            </h2>
                        </div>
                        <div className="bg-gray-700 rounded-md padding-4 w-[70%] min-h-40 flex flex-col">
                            <h2 className="text-3xl font-bold text-white p-2">
                                Impactful items in the world
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}
