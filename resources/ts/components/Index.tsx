export default function Index() {
    return (
        <>
            <div className="flex flex-col justify-center">
                <div className="relative z-10 flex flex-row justify-center items-center">
                    <h1 className="text-9xl text-white font-bold text-center">
                        Corevault
                    </h1>
                    <form action="post" className="flex flex-col justify-center items-center">
                        <input type="text" name="username"></input>
                        
                    </form>
                </div>
            </div>
        </>
    );
}
