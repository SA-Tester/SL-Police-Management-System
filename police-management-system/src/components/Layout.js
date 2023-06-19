import {Outlet,Link} from "react-router-dom";

const Layout = () => {
  return (
    <>
            <nav>
                <ul>
                    <li><Link to="/">Home</Link></li>
                    <li><Link to="/Complaints">Complaints</Link></li>
                    <li><Link to="/Duties">Duties</Link></li>
                    <li><Link to="/Leaves">Leaves</Link></li>
                    <li><Link to="/Payroll">Payroll</Link></li>
                    <li><Link to="/Employees">Employees</Link></li>
                    <li><Link to="/Settings">Settings</Link></li>
                    <li><Link to="/NoPage">NoPage</Link></li>
                    
                    <li><Link to="/complaints/RecordComplaints">Record Complaints</Link></li>
                </ul>
            </nav>
          <Outlet/>
    </>
  );
};

export default Layout;