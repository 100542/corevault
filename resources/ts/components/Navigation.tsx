export default function Navigation() {
  return (
    <>
      <div className="top-0 bg-gray-900 w-full h-24 flex flex-row justify-between items-center gap-16">
      <h1 className="text-4xl font-bold ml-16 text-center text-white">
          Corevault
        </h1>
        <div className="flex flex-row justify-between gap-16 mr-16 tracking-widest"> 
        <p className="text-2xl font-light text-center text-white">Dashboard</p>
        <p className="text-2xl font-light text-center text-white">Trading</p>
        <p className="text-2xl font-light text-center text-white">Market</p>
        <p className="text-2xl font-light text-center text-white">Profile</p>
        <p className="text-2xl font-light text-center text-white">Settings</p>
        </div>
      </div>
    </>
  );
}