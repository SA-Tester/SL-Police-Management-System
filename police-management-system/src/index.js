import ReactDOM from "react-dom/client";
import {BrowserRouter, Routes, Route} from "react-router-dom";

import Layout from "./components/Layout";
import Home from "./components/Home";
import Complaints from "./components/Complaints";
import Duties from "./components/Duties";
import Leaves from "./components/Leaves";
import Payroll from "./components/Payroll";
import Employees from "./components/Employees";
import Settings from "./components/Settings";
import NoPage from "./components/NoPage";

import RecordComplaints from "./components/complaints/RecordComplaints";

export default function App(){
        return(
                <BrowserRouter>
                    <Routes>
                        <Route path="/" element="{<Layout />}"/>
                        <Route index element={<Home />} />
                        <Route path="Complaints" element={<Complaints />} />
                        <Route path="Duties" element={<Duties />} />
                        <Route path="Leaves" element={<Leaves />} />
                        <Route path="Payroll" element={<Payroll />} />
                        <Route path="Employees" element={<Employees />} />
                        <Route path="Settings" element={<Settings />} />
                        <Route path="*" element={<NoPage />} />
                        
                        <Route path="RecordComplaints" element="{<RecordComplaints/>}"/> 
                    </Routes>
                </BrowserRouter>
        );
}

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(<App/>);