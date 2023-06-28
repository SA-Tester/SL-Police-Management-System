<<<<<<< Updated upstream
/*import React from 'react';
=======
import React from 'react';
>>>>>>> Stashed changes
import ReactDOM from 'react-dom/client';
import './index.css';
import App from './App';
import reportWebVitals from './reportWebVitals';

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <React.StrictMode>
    <App />
  </React.StrictMode>
);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
<<<<<<< Updated upstream
*/

import ReactDOM from "react-dom/client";
import {BrowserRouter, Routes, Route} from "react-router-dom";

import Home from "./components/Home";
import Complaints from "./components/Complaints";
import Duties from "./components/Duties";
import Leaves from "./components/Leaves";
import Payroll from "./components/Payroll";
import Employees from "./components/Employees";
import Settings from "./components/Settings";
import NoPage from "./components/NoPage";

import RecordComplaints from "./complaints/RecordComplaints";
import ViewPeople from "./complaints/ViewPeople";
import ComplaintStauts from "./complaints/ComplaintStatus";
import ComplaintStudies from "./complaints/ComplaintStudies"

import GeneralDuties from "./duties/GeneralDuties";
import SpecialDuties from "./duties/SpecialDuties";

import RequestLeave from "./leaves/RequestLeave";
import SubmitMedicals from "./leaves/SubmitMedicals";

import CalculateSalaries from "./payroll/CalculateSalaries";
import SendSalaries from "./payroll/SendSalaries";

export default function App(){
        return(
          <BrowserRouter>
              <Routes>
                  <Route index element={<Home />} />
                  <Route path="Complaints" element={<Complaints />} />
                  <Route path="Duties" element={<Duties />} />
                  <Route path="Leaves" element={<Leaves />} />
                  <Route path="Payroll" element={<Payroll />} />
                  <Route path="Employees" element={<Employees />} />
                  <Route path="Settings" element={<Settings />} />
                  <Route path="*" element={<NoPage />} /> 

                  <Route path="RecordComplaints" element={<RecordComplaints/>}/>
                  <Route path="ViewPeople" element={<ViewPeople/>} />
                  <Route path="ComplaintStatus" element={<ComplaintStauts/>}/>
                  <Route path="ComplaintStudies" element={<ComplaintStudies/>} />

                  <Route path="GeneralDuties" element={<GeneralDuties/>}/>
                  <Route path="SpecialDuties" element={<SpecialDuties/>}/>

                  <Route path="RequestLeave" element={<RequestLeave/>} />
                  <Route path="SubmitMedicals" element={<SubmitMedicals/>} />

                  <Route path="CalculateSalaries" element={<CalculateSalaries/>} />
                  <Route path="SendSalaries" element={<SendSalaries/>} />
              </Routes>
          </BrowserRouter>
        );
}

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(<App/>);
=======
>>>>>>> Stashed changes
