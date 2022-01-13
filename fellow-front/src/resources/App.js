import { Provider } from 'react-redux';
import { store } from '../store/store';
import { createMuiTheme, ThemeProvider } from '@material-ui/core';
import Routes from '../Routes';

// styles
import 'bootstrap/dist/css/bootstrap.min.css';
import '../assets/styles/index.css';

// components
import Loading from './components/geral/Loading';
import Notify from './components/geral/Notify';

const theme = createMuiTheme({
  palette: {
    primary: {
      main: '#0075EB'
    }
  }
})

function App() {
  return (
    <Provider store={store}>
      <ThemeProvider theme={theme}>
        <Loading />
        <Notify />
        <Routes />
      </ThemeProvider>
    </Provider>
  );
}

export default App;
