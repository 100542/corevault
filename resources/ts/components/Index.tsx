import "../../css/animations.css";
import axios from 'axios';

export default function Index() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken || '';

    return (
        <>
            <div className="flex flex-col justify-center min-h-screen bg-gray-800">
                <div className="relative z-10 flex flex-col justify-center items-center space-y-4">
                    <form
                        action="post"
                        className="flex flex-col gap-2 justify-center items-center space-y-4 border-2 border-white/30 backdrop-blur-md p-24 rounded-lg shadow-lg"
                    >
                        <h1 className="text-9xl text-white font-bold text-center">
                            Corevault
                        </h1>
                        <h2 className="text-3xl text-white/90 font-light tracking-widest">
                            Crypto. Organised. Simplified.
                        </h2>
                        <input
                            type="text"
                            name="username"
                            placeholder="Username"
                            className="p-2 border w-full border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#C9C7BA] text-[#29292B]"
                        />
                        <input
                            type="password"
                            name="password"
                            placeholder="Password"
                            className="p-2 border w-full border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#c9c7ba] text-[#29292B]"
                        />
                        <button
                            type="submit"
                            className="px-4 w-full py-2 bg-[#C9C7BA] text-[#29292B] rounded-md hover:bg-[#29292B] hover:text-[#C9C7BA] hover:gradientborder duration-300"
                        >
                            Log In
                        </button>
                        <p className="text-lg hover:cursor-pointer underline underline-offset-8 font-light text-white/90 tracking-widest">
                            Not registered yet? Join the world of crypto and
                            make a account!
                        </p>
                    </form>
                </div>
            </div>
        </>
    );
}
